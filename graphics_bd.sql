SELECT 
  "История студента".id, 
  "Студенты".change_history, 
  "Курсовые".id_students, 
  "Студенты".id_faculties, 
  "Факультеты".id, 
  "Студенты".id_spec, 
  "Специальность".id, 
  "Факультеты".id_dep, 
  "Кафедры".id, 
  "Студенты".id
FROM 
  public.cours_works "Курсовые", 
  public.departments "Кафедры", 
  public.faculties "Факультеты", 
  public.history_students "История студента", 
  public.speciality "Специальность", 
  public.students "Студенты", 
  public.users, 
  public.vkr_works "ВКР "
WHERE 
  "Кафедры".id = "Факультеты".id_dep AND
  "Факультеты".id = "Студенты".id_faculties AND
  "История студента".id = "Студенты".change_history AND
  "Специальность".id = "Студенты".id_spec AND
  "Студенты".id = "Курсовые".id_students AND
  "Студенты".id = "ВКР ".id_students;
