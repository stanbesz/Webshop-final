imageInp = document.getElementById("imageInp");
previewCont = document.getElementById("imagePreview");
previewImage = previewCont.querySelector("#image_preview_image");
previewText = previewCont.querySelector("#default_text");

imageInp.addEventListener("change",function(){
    const file = imageInp.files[0];
    if(file){
        reader = new FileReader();
        previewText.style.display = "none";
        previewImage.style.display = "block";
        reader.addEventListener("load", function(){
            console.log(reader);
            previewImage.setAttribute("src", reader.result);
        });
        reader.readAsDataURL(file);
    }
    else{
        previewText.style.display = null;
        previewImage.style.display = null;
        previewImage.setAttribute("src","");
    }
});