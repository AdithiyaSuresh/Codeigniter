import { Component, OnInit } from '@angular/core';
import { LabelnoteService } from 'src/app/service/labelnote.service';
import { FormControl, Validators } from '@angular/forms';

@Component({
  selector: 'app-labelnotes',
  templateUrl: './labelnotes.component.html',
  styleUrls: ['./labelnotes.component.scss']
})
export class LabelnotesComponent implements OnInit {

  flag = true;
  label;
  labelnme;
  title = new FormControl('', [Validators.required, Validators.required]);
  noteContent = new FormControl('', [Validators.required, Validators.required]);

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
      this.labelnme = this.label.label;
      console.log("label",this.label);
      console.log("labelname",this.labelnme);
    });
  }
}
