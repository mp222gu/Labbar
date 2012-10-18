	var $usernameCorrect = false;
 	var $passwordCorrect = false;
 	var $repeatedCorrect = false;
 	var $password = "";
$(document).ready(function() {
 
 
 	
 	$('.Username').blur(function(){
 		ValidateUsername(this);
 	});
 	$('.Username').focus(function(){
 	    $('.usernameconfirm').html('');
 		this.className = "Username";
 	});
 	$('.Password').blur(function(){
 		ValidatePassword(this);
 	});
 	$('.Password').focus(function(){
 		$('.passwordconfirm').html('');
 		this.className = "Password";
 	});
 	$('.PasswordRepeated').keyup(function(){
 		ValidateRepeatedPassword(this);
 	});
 	$('.PasswordRepeated').focus(function(){
 		
 	});
 	$('#registerButton').click(function(e){
 		e.preventDefault();
 		if($usernameCorrect && $passwordCorrect && $repeatedCorrect){
 			$('#registerform').submit();
 		}
 		else{
 			 $('.formconfirm').html("<p class='unvalid' >Form is not valid</p>");
 		}
 	})
 
 
});

 function ValidateUsername(textbox) {
            var pattern = /^[a-zA-Z0-9]{5,}$/;
            var match = pattern.test(textbox.value);
          
            if(match) {
            	$confirmation = '<p class="valid">Username OK</p>' ;
            	$usernameCorrect= true;
            }
            else{
            	$usernameCorrect = false;
            	if(textbox.value.length < 5 ){
            		$confirmation = '<p class="unvalid">Username too short</p>' ;
            	}
            	else{
            		$confirmation = '<p class="unvalid">Username not correct</p>';
            	}
            }
            $('.usernameconfirm').html($confirmation);
        }
function ValidatePassword(textbox) {
            var pattern = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}/;
            var match = pattern.test(textbox.value);
            if(match){
            	$passwordCorrect = true;
            	$password = textbox.value;
            	$confirmation = '<p class="valid">Password OK</p>' ;
            	}
            else {
            	$passwordCorrect = false;
            	if(textbox.value.length < 8 ){
            	$confirmation = '<p class="unvalid">Password to short</p>';
            	
           		}
           		else{
           			$confirmation = '<p class="unvalid">Password not correct</p>';
           		}
           	
           }
           
            $('.passwordconfirm').html($confirmation);
            
        }
function ValidateRepeatedPassword(textbox) {
            
            
            if(textbox.value == $password && textbox.value.length > 0){
            	$confirmation = '<p class="valid">Passwords match</p>';
            	$repeatedCorrect = true;
            } 
            else{
            	
            	$confirmation = '<p class="unvalid">Passwords dont match</p>' + textbox.value + $password ;
            }
           
            $('.repeatedpasswordconfirm').html($confirmation);
            
        }
