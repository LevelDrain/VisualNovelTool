const init = () => {
    const read = document.querySelector('#Container');

    $('#ajax').on('click', () => {
        $.ajax({
            url: 'php/request.php',
            type: 'POST',
            data: {
                'clicked': 'clicked'
            }
        })
            // Ajaxリクエストが成功した時発動
            .done((json) => {
                const strAry = JSON.parse(json);
                textReading(read, strAry);
            })
            // Ajaxリクエストが失敗した時発動
            .fail((fail_data) => {
                $('.result').html(fail_data);
                console.log(fail_data);
            })
            // Ajaxリクエストが成功・失敗どちらでも発動
            .always((data) => {
                console.log(data);
            });
    });
}
document.addEventListener('DOMContentLoaded', init);

// キャラクターのセリフをおくる関数
const textReading = (readBox, parsedJson) => {
    const imageArea = document.getElementById('picture');
    const posLeft = document.getElementById('posLeft');
    const posRight = document.getElementById('posRight');
    let i = 0, imageURL = '', message = '';

    readBox.addEventListener('click', () => {
        if (i < parsedJson.length) {
            imageURL = 'img/' + parsedJson[i].imageurl;
            message = parsedJson[i].name + '「' + parsedJson[i].serif + '」';
            $('.result').html(message);

            //TODO: 画像は読み込み方が文章と違うので、関数を分ける
            if (parsedJson[i].position == 'left') {
                posLeft.src = imageURL;
            } else if (parsedJson[i].position == 'right') {
                posRight.src = imageURL;
            }
            //console.log(message);
            //UPDATE `textdata` SET `id` = '8' WHERE `textdata`.`id` = 7
            i++;
        }
    });
}