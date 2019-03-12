import { Component, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import { LoginService } from 'src/app/service/login.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-reset',
  templateUrl: './reset.component.html',
  styleUrls: ['./reset.component.scss']
})

export class ResetComponent implements OnInit {

  message = '';
  model: any = {};
  public value = "";
  public session = "";
  public resMessage = "";


  /**
    * @description email validation 
    */
  password = new FormControl('', [Validators.required, Validators.minLength(8)]);

  /**
   * @description email validation 
   */
  confirm = new FormControl('', [Validators.required, Validators.minLength(8)]);

  /**
    * @method passwordErrorMessage()
    * @return void
    * @description Function to error validation
    */
  passwordErrorMessage() {
    return this.password.hasError('required') ? 'Password is required' :
      this.password.hasError('minlength') ? 'The password should of minimum of 8 digits' :
        '';
  }

  /**
   * @method cpasswordErrorMessage()
   * @return void
   * @description Function to error validation
   */
  cpasswordErrorMessage() {
    debugger;
    return this.confirm.hasError('required') ? 'ConfirmPassword is required' :
      this.confirm.hasError('minlength') ? 'The password should of minimum of 8 digits' :
        this.password.value != this.confirm.value ? 'password doesnot match' :
          '';
  }



  constructor(private logService: LoginService, private router: Router) { }

  /**
   * @method ngOnInit()
   * @return void
   * @description Function to fetch data
   */
  ngOnInit() {
    let obs = this.logService.getEmail();
    obs.subscribe((res: any) => {
      this.value = res.key;
      this.session = res.session;
    });
  }

  /**
   * @method reset()
   * @return void
   * @description Function to reset the user password
   */
  reset() 
  {
      this.model = {
        "password": this.password.value
      }

      if (this.password.value != this.confirm.value) 
      {
        this.message = "Password doesnot match";
        return;
      }
      else 
      {
        let obs = this.logService.UserResetData(this.model);
        obs.subscribe((res: any) => {
          if (res.message == "200") 
          {
            alert("Reset password done successfully");
            this.router.navigate(['/login']);
          }
          else 
          {
            this.router.navigate(['/sessionexp']);
          }
        });
      }
  }

}
