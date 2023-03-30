//image preview before uploading
function ShowPreviewImage(ImgInputFieldId,ImgPreviewId){
                    
                    var file = document.getElementById(ImgInputFieldId).files[0];
                    if(file.size>2000000)
                    {
                        alert('Image is greate than 2 mb');
                       document.getElementById(ImgInputFieldId).value = "";
                         $("#"+ImgPreviewId).attr("style","display:none;"); 
                        return false;
                    }

                    var imagename = file['name'];
                    var image_regex =  /^.*\.(jpeg|JPEG|png|PNG|jpg|JPG)$/;
                    if (!image_regex.test(imagename)) 
                    {
                        alert("Only jpg,jpeg,png file are accepted");
                         document.getElementById(ImgInputFieldId).value = "";
                          $("#"+ImgPreviewId).attr("style","display:none;"); 

                        return false;
                    }

                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function (event) {
                            $("#"+ImgPreviewId).attr("src", event.target.result);
                             $("#"+ImgPreviewId).attr("style","display:block;"); 
                        };
                        reader.readAsDataURL(file);
                    }
                
}
//image preview complete


//ck editor
function ckeditor(field_id,file_browser_Upload_Url){
    

    CKEDITOR.replace( field_id, {
    filebrowserUploadUrl: file_browser_Upload_Url,
    filebrowserUploadMethod: 'form',
    allowedContent:true,
});

    CKEDITOR.dtd.$removeEmpty.i = 0;
}

function addEmailValidation(){
 $.validator.addMethod("customemail", function (value, element) {
    return this.optional(element) || /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
  }, "Please enter a valid email address.");
}


function addPostalCodeValidation(){
 $.validator.addMethod("custompostalcode", function (value, element) {
    return this.optional(element) || /^[ABCEGHJ-NPRSTVXY][0-9][ABCEGHJ-NPRSTV-Z] [0-9][ABCEGHJ-NPRSTV-Z][0-9]$/.test(value);
  }, "Please enter a valid postal code");
}

function addTelephoneValidation(){
 $.validator.addMethod("customtelephone", function (value, element) {
    return this.optional(element) || /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(value);
  }, "Please enter a valid telephone number");
}


function addCardValidation(){
 $.validator.addMethod("customcard", function (value, element) {
    return this.optional(element) || /^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/.test(value);
  }, "Please enter a valid card number");
}


function addArrayInputValidation(){
   $.validator.addMethod("array_input_required", function(value, elem){
        // Use the name to get all the inputs and verify them
        var name = elem.name;
        return  $('input[name="'+name+'"]').map(function(i,obj){return $(obj).val();}).get().every(function(v){ return (v.length>2)?true:false; });
    });
}