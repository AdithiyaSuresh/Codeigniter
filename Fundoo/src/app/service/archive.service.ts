import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { serviceUrl } from '../ServiceUrl/serviceurl.service';

@Injectable({
  providedIn: 'root'
})

export class ArchiveService {

  constructor(private http:HttpClient,private serviceurl: serviceUrl) { }

  fetchArchive(uid){
    let fetarc = new FormData();
    fetarc.append("uid",uid);
    return this.http.post(this.serviceurl.host+this.serviceurl.fetchArch,fetarc);
  }

  unarchived(id,flag){
    let unarch = new FormData();
    unarch.append("uid",id);
    return this.http.post(this.serviceurl.host+this.serviceurl.unarchived,unarch);
  }

}
