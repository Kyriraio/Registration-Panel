$( document ).ready( function() {
    $("#loginAccount").click( function() {
    
        $(".error").html("");
        
    sendAjaxLoginForm("#login_form","db_login.php");
    return false;
    
    });
    });
    function sendAjaxLoginForm(ajax_form,url){
        $.ajax({
            type:     "POST",
            dataType: "json",
            url:      url,
            data:     $(ajax_form).serialize(),
            
            success: function(response) { 
                
                if(response.length == 0)
                {
                  alert("Пользователь успешно вошёл");
                  document.location.href = "index.php";
                }
                else
                {
                    if(! (response['login'] === undefined))
                    {
                        $("#_loginError").html(response['login']);
                    }
          
                    if(! (response['password'] === undefined))
                    {
                      $("#_passwordError").html(response['password']);
                    }
          
                }
                
            },      
            
            error: function(response) {
                alert("Что-то пошло не так");
            }
        });
        }