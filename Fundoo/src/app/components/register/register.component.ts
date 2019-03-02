import { Component, OnInit, Injectable } from '@angular/core';
import {FormBuilder, FormGroup,Validators,FormControl} from '@angular/forms';
import { Router } from '@angular/router';
import {RegisterModel} from 'src/app/models/register.model';


@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})

@Injectable()

export class RegisterComponent implements OnInit {

  constructor(private router:Router,private formBuilder:FormBuilder) { }
  user: RegisterModel = new RegisterModel();

  registrationForm = this.formBuilder.group({
    firstname: [this.user.firstname,Validators.required],
    lastname: [this.user.lastname,Validators.required],
    username: [this.user.username,Validators.required],
    emailid: [this.user.emailid, [Validators.required, Validators.email,Validators.pattern('^[a-zA-Z0-9._]+@[a-zA-Z]+.[a-zA-Z]+$')]],
    password1: [this.user.password1,[Validators.required, Validators.minLength(8)]],
    password2: [this.user.password2,[Validators.required, Validators.minLength(8)]]
  });

  firstname = new FormControl('',[Validators.required])
  lastname = new FormControl('',[Validators.required])
  username = new FormControl('',[Validators.required])
  emailid = new FormControl('', [Validators.required, Validators.email,Validators.pattern('^[a-zA-Z0-9._]+@[a-zA-Z]+.[a-zA-Z]+$')])
  password1 = new FormControl('', [Validators.required, Validators.minLength(8)])
  password2 = new FormControl('', [Validators.required, Validators.minLength(8)])


  ngOnInit() {}

  onSubmit() {
    console.log(this.registrationForm.value);
  }

  getErrorMessageUsername() {
     this.username.hasError('required') ? 'Username Required.' : '';
  }
  getErrorMessageEmail() {
    // tslint:disable-next-line:max-line-length
     this.emailid.hasError('required') ? 'Please Enter Correct Email' : this.emailid.hasError('email') ? 'Please Enter Correct Email' : '';
  }
  getErrorMessagePassword() {
     this.password1.hasError('required') ? 'password should be at least 8 characters' : '';
  }
  getErrorMessageCPassword() {
     this.password2.hasError('required') ? 'password should be at least 8 characters' : '';
  }
}
