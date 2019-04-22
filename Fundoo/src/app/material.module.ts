import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {

  MatButtonModule, MatCardModule, MatDialogModule, MatInputModule, MatTableModule,

  MatToolbarModule, MatMenuModule, MatIconModule, MatProgressSpinnerModule, MatFormFieldModule, 
  MatSidenavModule, MatListModule, MatGridListModule, MatDatepickerModule, MatNativeDateModule, MatTooltipModule, MatChipsModule, MatSnackBarModule, MatDialogRef, MAT_DIALOG_DATA, } from '@angular/material';
import {DragDropModule} from '@angular/cdk/drag-drop';


import {MatCheckboxModule} from '@angular/material/checkbox';  

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
    MatTooltipModule,
    MatChipsModule,
    MatSnackBarModule,
    DragDropModule,
    MatCheckboxModule
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
    MatTooltipModule,
    MatChipsModule,
    MatSnackBarModule,
    DragDropModule,
    MatCheckboxModule
    
  ],

  providers:[{ provide: MatDialogRef, useValue: {} },
    { provide: MAT_DIALOG_DATA, useValue: [] },
  ]
  
})
export class MaterialModule { }
