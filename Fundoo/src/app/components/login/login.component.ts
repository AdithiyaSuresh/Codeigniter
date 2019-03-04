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


  @Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.scss']
  })

  export class LoginComponent implements OnInit {

    message='';

     /**
     * @description email validation 
     */
    email = new FormControl('', [Validators.required, Validators.email]);

     /**
     * @description password validation 
     */
    password = new FormControl('', [Validators.required]);


    constructor(private router: Router) { }

    ngOnInit() {
    }


    /**
     *@description gets fiels empty error message
     */
    login() 
    {
      if(this.email.value== '' || this.password.value== '')
      {
        this.message="Field cannot be empty";
      }
      else this.message="";
    }
}
