


function formValidate(form)
{
	var input = [];
	//var fname, lname, username, email, pass1, pass2;

	var error_ = false;
	var error;
	var glyph_ok;
	var glyph_error;

	var atpos;
	var dotpos;


	switch (form) 
	{ 
		case "signup":
			error = document.getElementsByClassName("form_error_signup"); 
			glyph_ok = document.getElementsByClassName("ok_signup");
			glyph_error = document.getElementsByClassName("remove_signup");

			input = [
					 document.forms[form]["fname"].value,    //fname
					 document.forms[form]["lname"].value,    //lname
					 document.forms[form]["username"].value, //username
					 document.forms[form]["email"].value,    //email
					 document.forms[form]["pass1"].value,    //pass1
					 document.forms[form]["pass2"].value     //pass2
					];

			atpos = input[3].indexOf("@");
			dotpos = input[3].lastIndexOf(".");


			for(var i=0; i<input.length; i++)
			{														               //EMPTY
				if(input[i] === "" || input[i] === null || input[i].match(/^\s*$/))
				{

					glyph_ok[i].setAttribute("style", "color: transparent !important");
					glyph_error[i].setAttribute("style", "color: rgb(106,107,109) !important");
					
					error[i].innerHTML = "This field must be filled out";
					//error[i].style.display = "block";

					error_ = true;
				}
				else
				{
					glyph_ok[i].setAttribute("style", "color: rgb(106,107,109)  !important");
					glyph_error[i].setAttribute("style", "color: transparent !important");
					
					error[i].innerHTML = "";
					//error[i].style.display = "none";
																					 //EMAIL
					if (atpos < 1 || dotpos < atpos+2 || dotpos+2 >= input[3].length) 
					{
						glyph_ok[3].setAttribute("style", "color: transparent !important");
						glyph_error[3].setAttribute("style", "color: rgb(106,107,109) !important");
						
						error[3].innerHTML = "Not a valid email address";
						//error[3].style.display = "block";

						error_ = true;
					} 
					else
					{
											   //PASS1
						if(input[4].length < 6)
						{
							glyph_ok[4].setAttribute("style", "color: transparent !important");
							glyph_error[4].setAttribute("style", "color: rgb(106,107,109) !important");
							
							error[4].innerHTML = "Your password must contain atleast a minimum of 6 characters";
							//error[4].style.display = "block";

							error_ = true;
						} 
										        //PASS2
						if(input[5] !== input[4])
						{
							glyph_ok[5].setAttribute("style", "color: transparent !important");
							glyph_error[5].setAttribute("style", "color: rgb(106,107,109) !important");
								
							error[5].innerHTML = "The password fields do not match";
							//error[5].style.display = "block";

							error_ = true;
							 
						}
					}

				}
			}
		break;





		case "footer_form": 
			error = document.getElementsByClassName("form_error_footer"); 
			glyph_ok = document.getElementsByClassName("ok_footer");
			glyph_error = document.getElementsByClassName("remove_footer");


			input = [
					 document.forms[form]["fname"].value, //fname
					 document.forms[form]["email"].value  //email
					];


			atpos = input[1].indexOf("@");
			dotpos = input[1].lastIndexOf(".");
			

			for(var i=0; i<input.length; i++)
			{														               //EMPTY
				if(input[i] === "" || input[i] === null || input[i].match(/^\s*$/))
				{
					
					glyph_ok[i].setAttribute("style", "color: transparent !important");
					glyph_error[i].setAttribute("style", "color: rgb(106,107,109) !important");
					
					error[i].innerHTML = "This field must be filled out";
					//error[i].style.display = "block";

					error_ = true;
				}	
				else
				{				
					glyph_ok[i].setAttribute("style", "color: rgb(106,107,109)  !important");
					glyph_error[i].setAttribute("style", "color: transparent !important");
					
					error[i].innerHTML = "";
					//error[i].style.display = "none";
																					 //EMAIL
					if (atpos < 1 || dotpos < atpos+2 || dotpos+2 >= input[1].length) 
					{

						glyph_ok[1].setAttribute("style", "color: transparent !important");
						glyph_error[1].setAttribute("style", "color: rgb(106,107,109) !important");
						
						error[1].innerHTML = "Not a valid email address";
						//error[1].style.display = "block";

						error_ = true;
					} 
				
				}
			}
		break;



case "sidebar_form": 
			error = document.getElementsByClassName("form_error_sidebar"); 
			glyph_ok = document.getElementsByClassName("ok_sidebar");
			glyph_error = document.getElementsByClassName("remove_sidebar");


			input = [
					 document.forms[form]["fname"].value, //fname
					 document.forms[form]["email"].value  //email
					];


			atpos = input[1].indexOf("@");
			dotpos = input[1].lastIndexOf(".");
			

			for(var i=0; i<input.length; i++)
			{														               //EMPTY
				if(input[i] === "" || input[i] === null || input[i].match(/^\s*$/))
				{
					
					glyph_ok[i].setAttribute("style", "color: transparent !important");
					glyph_error[i].setAttribute("style", "color: rgb(106,107,109) !important");
					
					error[i].innerHTML = "This field must be filled out";
					//error[i].style.display = "block";

					error_ = true;
				}	
				else
				{				
					glyph_ok[i].setAttribute("style", "color: rgb(106,107,109)  !important");
					glyph_error[i].setAttribute("style", "color: transparent !important");
					
					error[i].innerHTML = "";
					//error[i].style.display = "none";
																					 //EMAIL
					if (atpos < 1 || dotpos < atpos+2 || dotpos+2 >= input[1].length) 
					{

						glyph_ok[1].setAttribute("style", "color: transparent !important");
						glyph_error[1].setAttribute("style", "color: rgb(106,107,109) !important");
						
						error[1].innerHTML = "Not a valid email address";
						//error[1].style.display = "block";

						error_ = true;
					} 
				
				}
			}
		break;



		case "login":

			error = document.getElementsByClassName("form_error_login"); 
			glyph_ok = document.getElementsByClassName("ok_login");
			glyph_error = document.getElementsByClassName("remove_login");


			input = [
					 document.forms[form]["username"].value,  //username
					 document.forms[form]["password"].value   //password
					];
			

			for(var i=0; i<input.length; i++)
			{														               //EMPTY
				if(input[i] === "" || input[i] === null || input[i].match(/^\s*$/))
				{
					
					glyph_ok[i].setAttribute("style", "color: transparent !important");
					glyph_error[i].setAttribute("style", "color: rgb(106,107,109) !important");
					
					error[i].innerHTML = "This field must be filled out";
					//error[i].style.display = "block";

					error_ = true;
				}	
				else
				{				
					glyph_ok[i].setAttribute("style", "color: rgb(106,107,109)  !important");
					glyph_error[i].setAttribute("style", "color: transparent !important");
					
					error[i].innerHTML = "";

					/*															 //password
					if () 
					{

						glyph_ok[1].setAttribute("style", "color: transparent !important");
						glyph_error[1].setAttribute("style", "color: rgb(106,107,109) !important");
						
						error[1].innerHTML = "";

						error_ = true;
					} 
					*/
				
				}
			}
		break;

	}

	if(error_){return false;}
	else{return true;}

}