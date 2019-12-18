//-- 以下、enchant.js を使わない方法 --
// キャラクターのセリフをおくる関数
const textReading = (readBox, parsedJson) => {
  const $posLeft = document.querySelector("#posLeft"),
    $posRight = document.querySelector("#posRight"),
    $effect = document.querySelector(".Effect");

  let i = 0,
    imageURL = "",
    message = "";

  readBox.addEventListener("click", () => {
    if (i < parsedJson.length) {
      // エフェクト操作
      if (parsedJson[i].effect == "blackout") {
        effectObj.blackFadeIn($effect);
      } else if (parsedJson[i].effect == "snow") {
        effectObj.snow($effect);
      } else {
        effectObj.resetEffect($effect); //エフェクトが空の時は全て削除
      }

      imageURL =
        parsedJson[i].imageurl != null ? "img/" + parsedJson[i].imageurl : null;

      message =
        parsedJson[i].name != null && parsedJson[i].serif != null
          ? parsedJson[i].name + "「" + parsedJson[i].serif + "」▼"
          : "▼";
      $(".Result").html(message);

      if (imageURL == null) {
        $posLeft.setAttribute("src", "");
        $posRight.setAttribute("src", "");
      } else {
        if (parsedJson[i].position == "left") {
          $posLeft.src = imageURL;
        } else if (parsedJson[i].position == "right") {
          $posRight.src = imageURL;
        }
      }
      i++;
    }
  });
};

//エフェクト生成オブジェクト-----------------------------------
const effectObj = {
  blackFadeIn: (target) => {
    target.classList.add("SetBlackFadeIn");
  },
  snow: (target) => {
    SnowObj(target);
  },
  resetEffect: (target) => {
    target.classList.remove("SetBlackFadeIn");
  }
}

//雪を降らせる
function SnowObj(target) {
  const $ctx = target.getContext("2d");

  //canvasサイズ
  const frameWidth = "800",
    frameHeight = "495";
  $ctx.canvas.width = frameWidth;
  $ctx.canvas.height = frameHeight;

  const animFrame = window.requestAnimationFrame || window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame ||
    function (callback) {
      window.setTimeout(callback, 1000 / 100);
    };

  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 5)) + min;
  }

  const snows = [];

  // 雪の粒の初期位置とサイズの設定
  function snow() {
    this.position_x = getRandomInt(10, frameWidth);
    this.position_y = getRandomInt(10, frameHeight);
    this.snow_size = getRandomInt(1, 5);
    this.speed = getRandomInt(0, 5); //落下速度
    this.wind = getRandomInt(1, 0.2); //横風の強さ
  }

  // 雪の粒の描画
  snow.prototype.draw = function () {
    var snow_grad = $ctx.createRadialGradient(
      this.position_x,
      this.position_y,
      this.snow_size * 0.8,
      this.position_x,
      this.position_y,
      this.snow_size
    );

    /* グラデーション終点のオフセットと色をセット */
    snow_grad.addColorStop(0, 'rgba(225, 225, 225, 0.8)');
    snow_grad.addColorStop(0.5, 'rgba(225, 225, 225, 0.2)');
    snow_grad.addColorStop(1, 'rgba(225, 225, 225, 0.1)');

    $ctx.beginPath(); //現在のパスをリセットする

    //グラデーションを
    //fillStyle（塗りつぶしの色やスタイルを指定する）プロパティにセット
    $ctx.fillStyle = snow_grad;

    //canvasに円を描画する
    $ctx.arc(this.position_x, this.position_y, this.snow_size, 0, Math.PI * 2);

    $ctx.fill(); //現在の塗りつぶしスタイルでサブパスを塗りつぶす
    $ctx.closePath(); //パスを閉じる
  }
  // 雪の粒の移動
  snow.prototype.move = function () {
    this.position_x += this.wind + Math.sin(this.position_y / 20) * 0.3;
    this.position_y += this.speed;

    if (this.position_y > $ctx.canvas.height) {
      this.position_y = 0;
      this.position_x = getRandomInt(0, frameWidth);
    }
  }

  // 雪の粒の密度(雪の量)
  function snow_density(snow_count) {
    for (var num = 0; num < snow_count; num++) {
      snows[num] = new snow();
    }
  }

  /* 雪を降らす処理 */

  //雪の粒を描画する
  function snow_draw() {
    $ctx.clearRect(0, 0, frameWidth, frameHeight);
    for (var num = 0; num < snows.length; num++) {
      snows[num].draw();
    }
  }

  //雪の粒の座標を更新する
  function snow_move() {
    for (var num = 0; num < snows.length; num++) {
      snows[num].move();
    }
  }

  //ループ処理
  function snowy() {
    snow_draw();
    snow_move();
    animFrame(snowy);
  }

  snow_density(100); //雪の量の指定
  snowy();
}
