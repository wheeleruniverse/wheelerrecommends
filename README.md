[![web](https://github.com/wheeleruniverse/wheelerrecommends/actions/workflows/web.yml/badge.svg)](https://github.com/wheeleruniverse/wheelerrecommends/actions/workflows/web.yml)

## Wheeler Recommends -- Serverless PHP Movie Recommendation Engine

This repository contains the code for wheelerrecommends.com, a serverless PHP movie recommendation engine. It demonstrates unconventional techniques for bold developers leveraging AWS Serverless technologies to host dynamic websites. The project prioritizes cost-efficiency, rapid scalability, and ease of maintenance. 

### Features

- Serverless Architecture: Built entirely on AWS serverless services, eliminating the need to manage underlying servers. 
- Cost-Efficient: Designed to be significantly cheaper than traditional server deployments. 
- Scalability: Can (usually) scale faster to handle varying loads. 
- Ease of Maintenance: Simplifies operational overhead, making the application easier to maintain.
- Seamless AWS Integration: Integrates effortlessly with various AWS services for a robust and performant solution. 
- Dynamic Website Hosting: Serves dynamic content rendered server-side using AWS Lambda.
- Movie Recommendation Display: Presents a list of movie recommendations.

### Technologies Used

- Programming Language: PHP (specifically php-83-fpm runtime)

- AWS Services:
    - CloudFront: Content Delivery Network for serving static assets and routing requests.
    - S3 (Simple Storage Service): Stores static website assets (CSS, JS, images, favicon, robots.txt).
    - API Gateway: Acts as the entry point for API requests to Lambda functions.
    - Lambda: Executes PHP code in a serverless environment.
    - Athena: Used for querying data (e.g., analytics data collected by the scraper).
    - EventBridge: Schedules tasks, such as the Vacuum Cron function.
    - Route53: Manages domain name services, including custom domains.
    - Certificate Manager: Provides SSL certificates for custom domains.

- Frameworks:
    - Bref: An open-source project that helps run PHP applications on AWS Lambda.
    - Serverless Lift: A plugin for the Serverless Framework that extends its capabilities to deploy websites, queues, and storage buckets using AWS CDK.

- GitHub Actions for CI/CD: Automates the build and deployment process.


### Architecture

The website architecture involves CloudFront distributing requests, with index.html and other static assets served from an S3 SPA Frontend. Dynamic content and API requests are routed to API Gateway, which then invokes Lambda functions. Analytics and other data can be processed and queried using Athena. EventBridge schedules a "Vacuum Cron" for maintenance tasks. 

For dynamic website hosting, requests to
website.com/* go through CloudFront, which then directs HTML rendering to a PHP Lambda function via API Gateway, while static assets (like /js/*, /css/*, /favicon.ico, /robots.txt) are served directly from S3.

### Deployment

The deployment process is automated using GitHub Actions. The web.yml workflow sets up Node.js and PHP, installs Serverless Framework and plugins (like Serverless Lift), installs Composer dependencies, and then deploys the serverless application. 

The serverless.yml configuration specifies the api function running on php-83-fpm runtime, with a timeout of 28 seconds (matching API Gateway's timeout). It also defines the cdn construct for managing CloudFront distribution, S3 assets, and custom domains, including SSL certificates and Route53 integration.
