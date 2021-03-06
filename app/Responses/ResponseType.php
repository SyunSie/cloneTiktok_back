<?php

namespace App\Responses;


class ResponseType {
    const Login = 'login';
    const Logout='logout';
    const GetUserInfo = 'get_user_info';
    const CreateAccount = 'create_account';
    
    const CreatePost = 'create_post';
    
    const GetUserPosts = 'get_user_posts';
    const GetPosts = 'get_posts';


    const SetUserLike = 'set_user_like';
    const CreatePostComment = 'create_post_comment';

    const SearchUser = 'search_user';
    const SearchPost = 'search_post';
}
