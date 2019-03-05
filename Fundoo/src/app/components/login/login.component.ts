  /******************************************************************************
   *
   *  Purpose         : this program is to redirect the valid user to the dashboard 
   *  @description    
   * 
   *  @file           : login.component.ts
   *  @overview       : to show the dashboard to an user.
   *  @module         : login.component.ts - This is optional if expeclictly its an npm or local package
   *  @author         : AdithiyaSuresh
   *  @version        : 1.0
   *  @since          : 29-02-2019
   *
   ******************************************************************************/
  /**
   * importing all the file from various module
   */
  import { Component, OnInit } from '@angular/core';
  import { FormControl, Validators } from '@angular/forms';
  import { Router } from '@angular/router';
  import { LoginService } from 'src/app/service/login.service';


  @Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.scss']
  })

  export class LoginComponent implements OnInit {

    message='';
    model: any = {};
    public iserror = false;
    public errorMessage = "";
	  usererror: string = "";

    /**
     * @description email validation 
     */
    email = new FormControl('', [Validators.required, Validators.email]);

    /**
     * @description password validation 
     */
    password = new FormControl('', [Validators.required,Validators.minLength(8)]);


    constructor(private router: Router,private logService:LoginService) { }

    ngOnInit() {}

    /**
     * @description Gets password error message
     */
    passwordErrorMessage(){
      return this.password.hasError('required') ? 'Password is required':
      this.password.hasError('minlength') ? 'The password must be of minimum 8 digits':
      '';
    }

    /**
     *@description gets fiels empty error message
     */
    login() 
    {
      debugger;
      this.model = {
        "email":this.email.value,
        "password":this.password.value
      }

      if(this.email.value== '' || this.password.value== '')
      {
        this.message="Field cannot be empty";
      }
      else 
      {
      this.message="";
      }

      console.log(this.model);
      debugger;
      let obs = this.logService.userLogin(this.model);
      
      obs.subscribe(
        (res: any) => 
        {
          if (res.message == "200") 
          {
            debugger;
            localStorage.setItem("token", res.token);
  
            this.router.navigate(["/fundoo"]);
          } 
          else if (res.message == "404") 
          {
            this.usererror = "user not found";
          } 
          else if (res.message == "401") 
          {
            this.usererror = "Email is Not Registered";
          } 
          else 
          {
            this.usererror = "invalid password";
          }
        },
        error => 
        {
          this.iserror = true;
          this.errorMessage = error.message;
        }
      );
    }

}
