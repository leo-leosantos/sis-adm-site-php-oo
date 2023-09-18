const formformEditHomeTopImg = document.getElementById("form-edit-home-top-img");
if (formformEditHomeTopImg) {
    formformEditHomeTopImg.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var new_image = document.querySelector("#new_image").value;
        // Verificar se o campo esta vazio
        if (new_image === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário selecionar uma imagem sts!</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}
function inputFileValImgSts() {
    //Receber o valor do campo
    var new_image = document.querySelector("#new_image");

    var filePath = new_image.value;

    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

    if (!allowedExtensions.exec(filePath)) {
        new_image.value = '';
        document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário selecionar uma imagem JPG ou PNG sts!</p>";
        return;
    } else {
        previewImageStsHomeTop(new_image);
        document.getElementById("msg").innerHTML = "<p></p>";
        return;
    }
}

function previewImageStsHomeTop(new_image) {
    if ((new_image.files) && (new_image.files[0])) {
        // FileReader() - ler o conteúdo dos arquivos
        var reader = new FileReader();
        // onload - disparar um evento quando qualquer elemento tenha sido carregado
        reader.onload = function(e) {
            document.getElementById('preview-img').innerHTML = "<img src='" + e.target.result + "' alt='Imagem' style='width: 250px;'>";
        }
    }

    // readAsDataURL - Retorna os dados do formato blob como uma URL de dados - Blob representa um arquivo
    reader.readAsDataURL(new_image.files[0]);
}