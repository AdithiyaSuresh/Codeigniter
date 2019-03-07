import { Injectable } from '@angular/core';
import { HttpClient} from '@angular/common/http';
import { LoginModel } from '../models/login.model';
import { serviceUrl } from '../ServiceUrl/serviceurl.service';

@Injectable({
  providedIn: 'root'
})

export class LoginService 
{
  
  constructor(private http: HttpClient,private serviceurl: serviceUrl) { }

  apiURL: string = 'http://localhost/codeigniter/signin';

  userLogin(log:LoginModel)
  {
    let userLogin = new FormData();
    userLogin.append("email",log.email);
    userLogin.append("password",log.password);
    return this.http.post(this.serviceurl.host+this.serviceurl.log,userLogin);
  }

  userPasswordRecoveryData(forgotp) {
		let userPassRecoveryData = new FormData();
		userPassRecoveryData.append("email", forgotp.email);
		return this.http.post(this.serviceurl.host + this.serviceurl.forgot,userPassRecoveryData);
	}

}
