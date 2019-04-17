import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-labelnotes',
  templateUrl: './labelnotes.component.html',
  styleUrls: ['./labelnotes.component.scss']
})
export class LabelnotesComponent implements OnInit {

  flag = true;

  constructor() { }

  ngOnInit() {
  }

  flip()
  {
    this.flag = !this.flag;
  }

  addNote()
  {
    this.flag = true;
  }
  
}
