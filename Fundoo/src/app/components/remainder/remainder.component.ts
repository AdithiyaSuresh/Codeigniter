import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-remainder',
  templateUrl: './remainder.component.html',
  styleUrls: ['./remainder.component.scss']
})
export class RemainderComponent implements OnInit {

  flag = true;
  
  constructor() { }

  ngOnInit() {
  }

  flip()
  {
    this.flag = !this.flag;
  }

}
