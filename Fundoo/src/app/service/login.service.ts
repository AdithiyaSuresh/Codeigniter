import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { LoginModel } from '../models/login.model';
import { serviceUrl } from '../ServiceUrl/serviceurl.service';
import { ActivatedRoute } from '@angular/router';

@Injectable({
  providedIn: 'root'
})

export class LoginService {

  constructor(private http: HttpClient, private serviceurl: serviceUrl, private route: ActivatedRoute) { }

  //apiURL: string = 'http://localhost/codeigniter/signin';

  /**
    * @method userLogin()
    * @return observable data
    * @param login
    * @description Function to send login data to server
    */
  userLogin(log: LoginModel) {
    let userLogin = new FormData();
    userLogin.append("email", log.email);
    userLogin.append("password", log.password);
    return this.http.post(this.serviceurl.host + this.serviceurl.log, userLogin);
  }

  /**
	 * @method userPasswordRecoveryData()
	 * @return observable data
	 * @param forgot
	 * @description Function to send forgot to server
	 */
  userPasswordRecoveryData(forgotp) {
    let userPassRecoveryData = new FormData();
    userPassRecoveryData.append("email", forgotp.email);
    return this.http.post(this.serviceurl.host + this.serviceurl.forgot, userPassRecoveryData);
  }

  /**
	 * @method getEmail()
	 * @return observable data
	 * @param reset
	 * @description Function to send get email from server
	 */
  getEmail() {
    debugger;
    let urlTocken = new FormData();
    urlTocken.append("token", this.route.snapshot.queryParamMap.get("token"));
    return this.http.post(this.serviceurl.host + this.serviceurl.getEmail, urlTocken);
  }

  /**
	 * @method UserResetData()
	 * @return observable data
	 * @param reset
	 * @description Function to send reset data to server
	 */
  UserResetData(reset) {
    debugger;
    let userResetData = new FormData();
    userResetData.append("token", this.route.snapshot.queryParamMap.get("token"));
    userResetData.append("password", reset.password);
    return this.http.post(this.serviceurl.host + this.serviceurl.reset, userResetData);
  }

  socialLogin(email,name){
    let social = new FormData();
    social.append("email",email);
    social.append("name",name);

    return this.http.post(this.serviceurl.host+this.serviceurl.sociallogin,social);
}

}
