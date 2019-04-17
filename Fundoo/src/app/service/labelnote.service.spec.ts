import { TestBed } from '@angular/core/testing';

import { LabelnoteService } from './labelnote.service';

describe('LabelnoteService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: LabelnoteService = TestBed.get(LabelnoteService);
    expect(service).toBeTruthy();
  });
});
