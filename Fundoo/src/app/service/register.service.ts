import { Injectable } from '@angular/core';
import { HttpClient} from '@angular/common/http';
import{RegisterModel} from '../models/register.model';
import { serviceUrl } from '../ServiceUrl/serviceurl.service';



@Injectable({
  providedIn: 'root'
})

export class RegisterService {

  constructor(private http: HttpClient,private serviceurl: serviceUrl) { }

  userRegister(reg:RegisterModel)
  {
    debugger;
    let userRegister = new FormData();
    userRegister.append("firstname",reg.firstname);
    userRegister.append("lastname",reg.lastname);
    userRegister.append("username",reg.username);
    userRegister.append("email",reg.email);
    userRegister.append("password",reg.password);
    userRegister.append("confirm",reg.confirm);
    debugger;
    return this.http.post(this.serviceurl.host+this.serviceurl.reg,userRegister);
  }

  addUserImage(image,uid)
  {
    let addUserImage = new FormData();
    addUserImage.append("image",image);
    addUserImage.append("uid",uid);
    return this.http.post(this.serviceurl.host+this.serviceurl.addUImage,addUserImage);
  }

  getImage(uid)
  {
    debugger;
    let getImg = new FormData();
    getImg.append('uid',uid);
    return this.http.post(this.serviceurl.host+this.serviceurl.getImage,getImg);
  }
}
