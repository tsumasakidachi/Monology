select monology.id as id, user_number, users.id as user_id, display_name, created_time, body
from monology, users
where monology.user_number = users.number
order by created_time desc