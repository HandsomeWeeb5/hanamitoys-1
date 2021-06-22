$(document).ready(function () {
  bsCustomFileInput.init();
});

$('#btnResetForm').click(function () {
  $('input[name=userImage').val('');
  $('label[id*="img-user-label"]').text('Upload Gambar');
  $('.img-preview').attr("src","img/default-user.jpeg");
})

// Preview Image
function previewImage() {
  const gambar = document.querySelector('#img-user');
  const imgPreview = document.querySelector('.img-preview');

  const oFReader = new FileReader();
  oFReader.readAsDataURL(gambar.files[0]);

  oFReader.onload = function (oFREvent) {
    imgPreview.src = oFREvent.target.result;
  };
}

/* When the user clicks on the button, toggle between hiding and showing the dropdown content*/ 
function activateDropdown(){
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event){
  if(!event.target.matches('.dropbtn')){
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for(i = 0; i < dropdowns.length; i++){
      var openDropdown = dropdowns[i];
      if(openDropdown.classList.contains('show')){
        openDropdown.classList.remove('show');
      }
    }
  }
}

// For quantity box
