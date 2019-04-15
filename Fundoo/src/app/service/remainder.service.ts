import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { serviceUrl } from '../ServiceUrl/serviceurl.service';

@Injectable({
  providedIn: 'root'
})
export class RemainderService {

  constructor(private http: HttpClient,private serviceurl: serviceUrl) { }

  fetchreminders(uid){
    debugger;
    let rem = new FormData();
    rem.append("uid",uid);
    return this.http.post(this.serviceurl.host+this.serviceurl.fetchReminder,rem);
  }

}
