import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {

  MatButtonModule, MatCardModule, MatDialogModule, MatInputModule, MatTableModule,

  MatToolbarModule, MatMenuModule, MatIconModule, MatProgressSpinnerModule, MatFormFieldModule, 
  MatSidenavModule, MatListModule, MatGridListModule, MatDatepickerModule, MatNativeDateModule, MatTooltipModule, } from '@angular/material';


@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    MatToolbarModule,
    MatButtonModule,
    MatCardModule,
    MatInputModule,
    MatDialogModule,
    MatTableModule,
    MatMenuModule,
    MatIconModule,
    MatProgressSpinnerModule,
    MatFormFieldModule,
    MatSidenavModule,
    MatListModule,
    MatGridListModule,
    MatDatepickerModule,       
    MatNativeDateModule,
    MatTooltipModule
  ],
  exports: [
    CommonModule,
    MatToolbarModule,
    MatButtonModule,
    MatCardModule,
    MatInputModule,
    MatDialogModule,
    MatTableModule,
    MatMenuModule,
    MatIconModule,
    MatProgressSpinnerModule,
    MatFormFieldModule,
    MatSidenavModule,
    MatListModule,
    MatGridListModule,
    MatDatepickerModule,       
    MatNativeDateModule,
    MatTooltipModule    
    
  ],
})
export class MaterialModule { }
