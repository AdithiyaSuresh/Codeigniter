import { Component, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';

@Component({
  selector: 'app-reset',
  templateUrl: './reset.component.html',
  styleUrls: ['./reset.component.scss']
})
export class ResetComponent implements OnInit {

  message = '';
  model: any = {};


  /**
    * @description email validation 
    */
   password = new FormControl('',[Validators.required,Validators.minLength(8)]);
   
   /**
    * @description email validation 
    */
   confirm = new FormControl('',[Validators.required,Validators.minLength(8)]);
   
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



  constructor() { }

  ngOnInit() {
  }

  reset()
  {
    this.model = {
      "password":this.password.value,
      "confirm":this.confirm.value
    }

    if (this.password.value != this.confirm.value)
      {
        this.message = "Password doesnot match";
        return;
      }
    else{
      this.message = "";
      }
  }

}
