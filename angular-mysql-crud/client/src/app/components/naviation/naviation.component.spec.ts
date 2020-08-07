import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { NaviationComponent } from './naviation.component';

describe('NaviationComponent', () => {
  let component: NaviationComponent;
  let fixture: ComponentFixture<NaviationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ NaviationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(NaviationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
