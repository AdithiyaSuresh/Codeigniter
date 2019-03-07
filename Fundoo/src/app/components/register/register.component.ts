  /******************************************************************************
 *
 *  Purpose         : this program is to register the user.
 *  @description    
 * 
 *  @file           : register.component.ts
 *  @overview       : To the user.
 *  @module         : register.ts - This is optional if expeclictly its an npm or local package
 *  @author         : Adithiya Suresh
 *  @version        : 1.0
 *  @since          : 29-02-2019
 *
 ******************************************************************************/

/**
 * importing all the file from various module
 */
  import { Component, OnInit} from '@angular/core';
  import { FormControl, Validators} from '@angular/forms';
  import {RegisterService} from '../../service/register.service';
  

  @Component({
    selector: 'app-register',
    templateUrl: './register.component.html',
    styleUrls: ['./register.component.scss']
  })



  export class RegisterComponent implements OnInit 
  {

    message = '';
    model: any = {};
    errormsg: string = "";

    /**
     * @description firstName validation 
     */
    firstname = new FormControl('', [Validators.required,Validators.pattern('[a-zA-Z]*')]);

    /**
     * @description lastName validation 
     */
    lastname = new FormControl('', [Validators.required,Validators.pattern('[a-zA-Z]*')]);

    /**
     * @description userName validation 
     */
    username = new FormControl('', [Validators.required,Validators.pattern('[a-zA-Z]*')]);

    /**
     * @description email validation 
     */
    email = new FormControl('', [Validators.required, Validators.email,Validators.pattern('^[a-zA-Z0-9._]+@[a-zA-Z]+.[a-zA-Z]+$')]);

    /**
     * @description password validation 
     */
    password = new FormControl('',[Validators.required,Validators.minLength(8)]);

    /**
     * @description password validation 
     */
    confirm = new FormControl('', [Validators.required,Validators.minLength(8)]);


    constructor(private regService:RegisterService) { }

    ngOnInit() {}

    /**
     * @description Gets fistName error message
     */
    firstNameErrorMessage(){
      return this.firstname.hasError('required') ? 'FirstName is required':
      this.firstname.hasError('pattern') ? 'Enter a valid name':
      '';
    }

    /**
     * @description Gets lastName error message
     */
    lastNameErrorMessage(){
      return this.lastname.hasError('required') ? 'LastName is required':
      this.lastname.hasError('pattern') ? 'Enter a valid name':
      '';
    }

    /**
     * @description Gets userName error message
     */
    userNameErrorMessage(){
      return this.username.hasError('required') ? 'UserName is required':
      this.username.hasError('pattern') ? 'Enter a valid name':
      '';
    }

    /**
     * @description Gets email error message
     */
    emailErrorMessage(){
      return this.email.hasError('required') ? 'Email is required':
      this.email.hasError('email') ? 'Not a valid email format':
      '';
    }

    /**
     * @description Gets password error message
     */
    passwordErrorMessage(){
      return this.password.hasError('required') ? 'Password is required':
      this.password.hasError('minlength') ? 'The password should of minimum of 8 digits':
      '';
    }
    
    /**
     * @description Gets password error message
     */
    cpasswordErrorMessage(){
      debugger;
      return this.confirm.hasError('required') ? 'ConfirmPassword is required':
      this.confirm.hasError('minlength') ? 'The password should of minimum of 8 digits':
      this.password.value != this.confirm.value ? 'password doesnot match':
      '';
    }

      /**
       *@description gets fiels empty error message
       */
      register() 
      {
        this.model = {
          "firstname": this.firstname.value,
          "lastname": this.lastname.value,
          "username":this.username.value,
          "email":this.email.value,
          "password":this.password.value,
          "confirm":this.confirm.value
        }

          if (this.firstname.value == '' || this.lastname.value == '' || this.username.value == '' ||  this.email.value == '' || this.password.value == '' || this.confirm.value == '') 
          {
            this.message = "Fields are missing";
            return;
          }
          else if (this.password.value != this.confirm.value)
          {
            this.message = "Password doesnot match";
            return;
          }
          else 
          {
            console.log(this.model);

            let obj = this.regService.userRegister(this.model);
  
            obj.subscribe((res: any) => 
            {
              //debugger;
              console.log(res.message);
  
              if (res.message == "200") 
              {
                this.errormsg = "registration is succesfull \n kindly verify your mail";
              } 
              else 
              {
                this.errormsg = "error 204 no content";
              }
            });
            
          }

         
      }

  }
