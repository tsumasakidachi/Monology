select `number`,`user_id` as `userId`, `access_token` as `accessToken`, `access_token_secret` as `accessTokenSecret`
from accounts
where `number` = :1