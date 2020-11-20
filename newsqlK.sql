SELECT
     values.id as id,
     values.field as field,
     values.text as text,
     form_fields.name as name,
     form_fields.type as name
 FROM form_fields
 INNER JOIN values ON form_fields.name = values.text
 WHERE
     `form_type_id` = :form_type_id 
 LIMIT 1