import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CalendarDetalleComponent } from './calendar-detalle.component';

describe('CalendarDetalleComponent', () => {
  let component: CalendarDetalleComponent;
  let fixture: ComponentFixture<CalendarDetalleComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CalendarDetalleComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CalendarDetalleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
