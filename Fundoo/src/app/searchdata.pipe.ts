import { Pipe, PipeTransform } from '@angular/core';
import { notEqual } from 'assert';

@Pipe({
  name: 'searchdata'
})
export class SearchdataPipe implements PipeTransform {

  transform(note: any[], searchTerm: string) {
    if(!note || !searchTerm){
    return [];
  }

  return note.filter(not =>
    not.title.indexOf(searchTerm) !==-1 || not.noteContent.indexOf(searchTerm) !== -1 );
  }
}
