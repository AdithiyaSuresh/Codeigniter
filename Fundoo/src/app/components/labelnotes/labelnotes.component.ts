import { Component, OnInit } from '@angular/core';
import { LabelnoteService } from 'src/app/service/labelnote.service';
import { FormControl, Validators } from '@angular/forms';
import { LabelService } from 'src/app/service/label.service';
import decode from 'jwt-decode';

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
  labelid;
  note: string[];
  labelname =  new FormControl('', [Validators.required, Validators.required]);
  labels: string[];
  uid;

  constructor(private labelser: LabelService,private labelnoteserv:LabelnoteService) { 
    this.getlname();
  }
  
  ngOnInit() {
    this.getlname();
    const tokens = localStorage.getItem('token');
    const tokenPayload = decode(tokens);
    this.uid = tokenPayload.id;
    this.displayLabels();

  }

  flip()
  {
    this.flag = !this.flag;
  }

  addNote()
  {
    this.flag = true;
  }
  
  displayLabels() {
    debugger;
    let fetchl = this.labelser.displayLabels(this.uid);

    fetchl.subscribe((res: any) => {
      debugger

      this.labels = res;
    })
  }

  getlname()
  {
    debugger
    this.labelnoteserv.getlname().subscribe((res:any)=>{
      debugger
      this.label = res;
      this.labelid = this.label.id;
      this.labelnme = this.label.label;
      console.log("label",this.label);
      console.log("labelname",this.labelnme);
      this.displayLabelNote();
    });

  }

  displayLabelNote()
  {
    let obsl = this.labelser.displayLabelNote(this.labelid);
      debugger;
    obsl.subscribe((data: any) => {
      debugger;
      this.note = data as string[];
      console.log(this.note);
    });
  }

}
