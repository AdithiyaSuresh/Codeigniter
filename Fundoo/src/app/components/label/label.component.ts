import { Component, OnInit, Inject } from '@angular/core';
import { MatDialogRef, MatDialog, MAT_DIALOG_DATA } from '@angular/material';
import { FormControl, Validators } from '@angular/forms';
import { LabelService } from 'src/app/service/label.service';

@Component({
  selector: 'app-label',
  templateUrl: './label.component.html',
  styleUrls: ['./label.component.scss']
})
export class LabelComponent implements OnInit {

  uid;
  model: any = {};
  labels: string[];

  labelname = new FormControl('', [Validators.required, Validators.required]);

  constructor(public dialogRef: MatDialogRef<LabelComponent>,public dialog: MatDialog,@Inject(MAT_DIALOG_DATA) public data: any, private labelser: LabelService) 
  {
    debugger;
    this.uid = this.data;
    this.displayLabel();
  }

  ngOnInit() {
    
    // setInterval(() => {
		// 	this.displayLabel();
		// }, 1000);
  }

 
 


  
  close() {

    this.dialogRef.close();
    this.model = {
      "labelname": this.labelname.value
    }

    debugger;
    let label = this.labelser.setLabel(this.uid,this.model);
    
    label.subscribe((res: any) => {
      
    });
    
  }

  displayLabel() {
    // debugger;
    let fetch = this.labelser.displayLabel(this.uid);

    fetch.subscribe((res: any) => {
      this.labels = res;
    })
  }


}
