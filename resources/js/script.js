// codigo da modal
function previewImage() {

    var imagem = document.querySelector(`input[id=fotoPerfil]`).files[0];
    var preview = document.querySelector(`img[id=preview]`);

    var read = new FileReader();
    read.onloadend = function () {
        preview.src = read.result;
    }

    if (imagem){
        read.readAsDataURL(imagem);
        abrirModal();
    } else{
        preview.src = "";
    }
}

function fecharModal()
{
    document.getElementById('fundo').style.display = 'none';
    document.getElementById('janela').style.display = 'none';
}

function abrirModal()
{
    document.getElementById('fundo').style.display = 'block';
    document.getElementById('janela').style.display = 'block';
}