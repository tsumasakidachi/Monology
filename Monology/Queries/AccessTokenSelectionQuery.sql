select `number`,`user_id` as `userId`, `access_token` as `accessToken`, `access_token_secret` as `accessTokenSecret`
from accounts
where `number` = :1
and `user_id` = :2
limit 1