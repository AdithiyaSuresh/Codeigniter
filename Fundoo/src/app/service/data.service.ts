import { Injectable } from '@angular/core';
import { Subject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class DataService {

  private searchWord:string;

  constructor() { }
  subject=new Subject();

  getSearch()
  {

    this.setSearchWord(this.searchWord);
    return this.subject.asObservable();
  } 

  setSearchWord(searchTerm:string)
  {
    this.searchWord=searchTerm;
    
    this.subject.next({data:searchTerm})
    
}

}
