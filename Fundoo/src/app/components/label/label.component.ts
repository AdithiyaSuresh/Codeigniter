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
  updateLabel = new FormControl('', [Validators.required, Validators.required]);

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
    if(this.labelname.value != "")
    {
      let label = this.labelser.setLabel(this.uid,this.model);
      
      label.subscribe((res: any) => {
        this.displayLabel();
        this.labelname.setValue('');
      });
    }
    
  }

  displayLabel() {
    // debugger;
    let fetch = this.labelser.displayLabel(this.uid);

    fetch.subscribe((res: any) => {
      this.labels = res;
    })
  }

  deleteLabel(id,flag)
  {

    debugger;
    let dell = this.labelser.deleteLabel(id,flag,this.updateLabel.value);

    dell.subscribe((res:any)=>{
      if(res.status == "200")
      {
        this.displayLabel();
      }
    });
  }

}
