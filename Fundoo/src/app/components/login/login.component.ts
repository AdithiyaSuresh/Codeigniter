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
  import {AuthService,FacebookLoginProvider,GoogleLoginProvider} from 'angular-6-social-login';
  import { HttpClient } from '@angular/common/http';
  import { CookieService } from 'ngx-cookie-service';

  @Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.scss']
  })

  export class LoginComponent implements OnInit {

    message='';
    model: any = {};
	  usererror: string = "";

    /**
     * @description email validation 
     */
    email = new FormControl('', [Validators.required, Validators.email]);

    /**
     * @description password validation 
     */
    password = new FormControl('', [Validators.required,Validators.minLength(8)]);


    constructor(private router: Router,private logService:LoginService,private socialAuthService: AuthService,private cookieserv:CookieService) { }

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
        // debugger;
        this.model =
        {
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

          console.log(this.model);

          let obj = this.logService.userLogin(this.model);
          obj.subscribe((res: any) => 
          {
            debugger;
            if (res.message == "400") 
            {
                this.usererror = "user logged in successfully";
                localStorage.setItem("token", res.token);
                localStorage.setItem("email",this.email.value);
                this.router.navigate(['/dashboard']);
            } 
            else if (res.message == "401") 
            {
              this.usererror = "password doesnot match";
            } 
            else if (res.message == "200") 
            {
              this.usererror = "Email is Not Registered, invalid user";
            } 
          },
        );
      }
    }


    public socialSignIn(socialPlatform : string) 
    {
      //debugger;
      let socialPlatformProvider;
      if(socialPlatform == "facebook"){
        socialPlatformProvider = FacebookLoginProvider.PROVIDER_ID;
      }else if(socialPlatform == "google"){
        socialPlatformProvider = GoogleLoginProvider.PROVIDER_ID;
      }
      
      this.socialAuthService.signIn(socialPlatformProvider).then((userData) => {
        //debugger
          console.log(socialPlatform+" sign in data : " , userData);
         this.sendToRestApiMethod(userData.token,userData.email,userData.image,userData.name); 
        }
      );
    } 
    
   msg;
    sendToRestApiMethod(token, email, image, name) {

      //debugger
      let socialres = this.logService.socialLogin(email,name);
      socialres.subscribe((res:any)=>{
       // debugger
        console.log(res);
        if(res.message=="200"){ 
         // debugger
          
          this.cookieserv.set("email",email);
          this.cookieserv.set("image",image);
          this.cookieserv.set("name",name);
          
          localStorage.setItem("token",res.token);
          
          this.router.navigate(["/dashboard"]);
        }
      })

    }

   }

  


