# Admin

```yml
# app/config/security.yml
security:
    encoders:
        Seferov\BlogBundle\Entity\User:
            algorithm: bcrypt

    providers:
        in_memory:
            memory: ~
        seferov_blog_user_provider:
            entity:
                class: SeferovBlogBundle:User
                property: username

    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
          
        blog:
            pattern: ^/blog/admin
            anonymous: ~
            logout:
                path: seferov_blog_admin_logout
            form_login:
                provider: seferov_blog_user_provider
                login_path: seferov_blog_admin_login
                check_path: seferov_blog_admin_login_check
        main:
            anonymous: ~

    access_control:
        - { path: ^/blog/admin/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/blog/admin, roles: ROLE_ADMIN }
        # ...

```