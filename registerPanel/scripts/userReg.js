$( document ).ready( function() {
    $("#createAccount").click( function() {
    
        $(".error").html("");
        
    sendAjaxRegForm("#reg_form","db_reg.php");
    return false;
    
    });
    });
    function sendAjaxRegForm(ajax_form,url){
        $.ajax({
            type:     "POST",
            dataType: "json",
            url:      url,
            data:     $(ajax_form).serialize(),
            
            success: function(response) { 
                
                if(response.length == 0)
                {
                  alert("Пользователь успешно добавлен");
                  document.location.href = "index.php";
                }
                else
                {
                    if(! (response['login'] === undefined))
                    {
                        $("#loginError").html(response['login']);
                    }
          
                    if(! (response['password'] === undefined))
                    {
                      $("#passwordError").html(response['password']);
                    }
          
                    if(! (response['cpassword'] === undefined))
                    {
                      $("#cpasswordError").html(response['cpassword']);
                    }
                    if(! (response['email'] === undefined))
                    {
                        $("#emailError").html(response['email']);
                    }
                }
                
            },      
            
            error: function() {
                alert("хуета__))]");
            }
        });
        }