import { Injectable } from '@angular/core';
import { HttpClient} from '@angular/common/http';
import{RegisterModel} from '../models/register.model';

@Injectable({
  providedIn: 'root'
})

export class RegisterService {

  constructor(private http: HttpClient) { }

  apiURL: string = 'http://localhost/codeigniter/signup';

  userRegister(reg:RegisterModel)
  {
    let userRegister = new FormData();
    userRegister.append("firstname",reg.firstname);
    userRegister.append("lastname",reg.lastname);
    userRegister.append("username",reg.username);

    userRegister.append("email",reg.email);

    userRegister.append("password",reg.password);

    userRegister.append("confirm",reg.confirm);

    return this.http.post(this.apiURL,userRegister);
  }

}
