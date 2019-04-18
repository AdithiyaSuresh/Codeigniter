import { Component, OnInit } from '@angular/core';
import { LabelnoteService } from 'src/app/service/labelnote.service';

@Component({
  selector: 'app-labelnotes',
  templateUrl: './labelnotes.component.html',
  styleUrls: ['./labelnotes.component.scss']
})
export class LabelnotesComponent implements OnInit {

  flag = true;
  label;
  labelnme;

  constructor(private labelnoteserv:LabelnoteService) { 
    this.getlname();
  }
  
  ngOnInit() {
    this.getlname();

  }

  flip()
  {
    this.flag = !this.flag;
  }

  addNote()
  {
    this.flag = true;
  }
  
  getlname()
  {
    debugger
    this.labelnoteserv.getlname().subscribe((res:any)=>{
      debugger
      this.label = res;
      this.labelnme = this.label.labelname;
      console.log("label",this.label);
      console.log("labelname",this.labelnme);
    });
  }
}
