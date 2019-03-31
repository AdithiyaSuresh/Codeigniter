import { Component, OnInit } from '@angular/core';
import decode from 'jwt-decode';
import { ArchiveService } from 'src/app/service/archive.service';


@Component({
  selector: 'app-archive',
  templateUrl: './archive.component.html',
  styleUrls: ['./archive.component.scss']
})
export class ArchiveComponent implements OnInit {

  note: [];

  constructor(private archserv : ArchiveService) { }
  
  ngOnInit() {
    this.fetchArchive();
  }
  public maticons: string[] = [
    'notification_important',
    'color_lens',
    'unarchive',
    'person_add',
    'more_vert',
  ];


  fetchArchive(){
    
    const token = localStorage.getItem('token');
    const tokenPayload = decode(token);
    const uid = tokenPayload.id;

    let archiveobs = this.archserv.fetchArchive(uid);
    debugger;
    archiveobs.subscribe((res:any)=>{
      this.note = res;
    }) 
  } 


  unarchive(id,flag){
    debugger

    let archive = this.archserv.unarchived(id,flag);
    archive.subscribe((res:any)=>{

    });


}


}
