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
                const jsonDataArray = JSON.parse(json);

                //★ ゲームのテキスト風の動作
                textReading(read, jsonDataArray);
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