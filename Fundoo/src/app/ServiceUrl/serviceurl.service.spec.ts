import { TestBed } from '@angular/core/testing';

import { serviceUrl } from './serviceurl.service';

describe('ServiceurlService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: serviceUrl = TestBed.get(serviceUrl);
    expect(service).toBeTruthy();
  });
});
