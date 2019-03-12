import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SessionexpComponent } from './sessionexp.component';

describe('SessionexpComponent', () => {
  let component: SessionexpComponent;
  let fixture: ComponentFixture<SessionexpComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SessionexpComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SessionexpComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
