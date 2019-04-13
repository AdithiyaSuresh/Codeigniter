import { Component, OnInit } from '@angular/core';
import decode from 'jwt-decode';
import { TrashService } from 'src/app/service/trash.service';

@Component({
  selector: 'app-trash',
  templateUrl: './trash.component.html',
  styleUrls: ['./trash.component.scss']
})

export class TrashComponent implements OnInit {

  note: [];

  constructor(private trashServ : TrashService) { }
  
  ngOnInit() {
    this.fetchTrash();
  }


  fetchTrash(){
    
    const token = localStorage.getItem('token');
    const tokenPayload = decode(token);
    const uid = tokenPayload.id;

    let archiveobs = this.trashServ.fetchTrash(uid);
    debugger;
    archiveobs.subscribe((res:any)=>{
      this.note = res;
    }) 
  } 


  trashed(id,flag){
    debugger

    let archive = this.trashServ.trashed(id,flag);
    archive.subscribe((res:any)=>{
      this.fetchTrash();
    });
}

restore(id,flag)
{
  debugger;
  let archive = this.trashServ.restore(id,flag);
    archive.subscribe((res:any)=>{
      this.fetchTrash();
    });
}


}
