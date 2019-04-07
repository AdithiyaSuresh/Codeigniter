import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { serviceUrl } from '../ServiceUrl/serviceurl.service';

@Injectable({
  providedIn: 'root'
})
export class LabelService {

  constructor(private http :HttpClient,private serviceurl:serviceUrl) { }

  setLabel(id,model){
    debugger;
    let label = new FormData();
    label.append("uid",id);
    label.append("label",model.labelname);
    return this.http.post(this.serviceurl.host+this.serviceurl.addLabels,label);
  }

  displayLabel(uid){
    debugger;
    let labelf = new FormData();
    labelf.append("uid",uid);
    return this.http.post(this.serviceurl.host+this.serviceurl.getLabel,labelf);
  }

  displayLabels(uid)
  {
   // debugger;
    let dlabel = new FormData();
    dlabel.append("uid",uid);
    return this.http.post(this.serviceurl.host+this.serviceurl.getLabel,dlabel);
  }

}
