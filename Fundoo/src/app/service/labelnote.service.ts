import { Injectable } from '@angular/core';
import { Subject } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { serviceUrl } from '../ServiceUrl/serviceurl.service';

@Injectable({
  providedIn: 'root'
})
export class LabelnoteService {

  constructor(private http :HttpClient,private serviceurl: serviceUrl) { }
  subject = new Subject();

  setLabelName(lname){


    this.subject.next(lname);

  }

}
