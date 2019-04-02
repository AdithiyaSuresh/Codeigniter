import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { serviceUrl } from '../ServiceUrl/serviceurl.service';

@Injectable({
  providedIn: 'root'
})
export class TrashService {

  constructor(private http:HttpClient,private serviceurl: serviceUrl) { }

  fetchTrash(uid){
    let fetchtrash = new FormData();
    fetchtrash.append("uid",uid);
    return this.http.post(this.serviceurl.host+this.serviceurl.fetchTrash,fetchtrash);
  }

  trashed(id,flag){
    let del = new FormData();
    del.append("uid",id);
    return this.http.post(this.serviceurl.host+this.serviceurl.delete,del);
  }
  
  restore(id,flag)
  {
    let rest = new FormData();
    rest.append("uid",id);
    return this.http.post(this.serviceurl.host+this.serviceurl.restore,rest);
  }
}
