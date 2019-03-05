import { Injectable } from '@angular/core';
import { HttpClient} from '@angular/common/http';
import { LoginModel } from '../models/login.model';

@Injectable({
  providedIn: 'root'
})
export class LoginService {
  
  constructor(private http: HttpClient) { }

  apiURL: 'http://localhost/codeigniter/signin';

  userLogin(log:LoginModel)
  {
    let userLogin = new FormData();
    return this.http.post(this.apiURL,userLogin);
  }
}
