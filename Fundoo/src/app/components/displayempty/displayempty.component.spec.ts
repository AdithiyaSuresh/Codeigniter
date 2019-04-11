import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DisplayemptyComponent } from './displayempty.component';

describe('DisplayemptyComponent', () => {
  let component: DisplayemptyComponent;
  let fixture: ComponentFixture<DisplayemptyComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DisplayemptyComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DisplayemptyComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
