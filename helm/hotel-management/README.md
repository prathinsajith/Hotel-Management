# hotel-management Helm chart

Deploys the Laravel hotel management app. The image built from this repo's
`Dockerfile` is a **single container** running nginx + php-fpm under supervisord,
so the chart deploys one Deployment, not a web/fpm pair.

## Install

```sh
helm upgrade --install hotel ./helm/hotel-management \
  --namespace hotel --create-namespace \
  --set image.repository=registry.example.com/hotel-management \
  --set image.tag=1.4.2 \
  --set app.url=https://hotel.example.com \
  --set database.host=mysql.db.svc.cluster.local \
  --set database.name=hotel_management \
  --set database.username=hotel \
  --set database.existingSecret=hotel-db \
  --set ingress.enabled=true \
  --set ingress.hosts[0].host=hotel.example.com
```

Render without a cluster:

```sh
helm template hotel ./helm/hotel-management
helm lint ./helm/hotel-management
```

## What the chart does

| Concern | Behaviour |
| --- | --- |
| Migrations | `php artisan migrate --force` as a `post-install,post-upgrade` hook Job, so it runs once per release. The Deployment sets `RUN_MIGRATIONS=false` so the image entrypoint never migrates. |
| Probes | `GET /healthz`, served by nginx without touching PHP. `startupProbe` covers the entrypoint's `config:cache` / `route:cache` / `view:cache` step. |
| Config | Non-secret env in a ConfigMap, secrets in a Secret; both are consumed with `envFrom`. The Deployment carries a `checksum/config` annotation so config changes roll the pods. |
| `APP_KEY` | Set `app.key`, or leave it empty and the chart generates one on install and reuses it on upgrade by reading back its own Secret. |
| Uploads | `public/images` optionally backed by a PVC, with an init container that copies the image's 56 seed images into an empty volume. |

## Things to know before you scale

- **`containerPort` is 80, not 8800.** nginx in the image has
  `listen 80 default_server`. The Dockerfile's `EXPOSE 8800` is metadata only
  and does not move the listener, so pointing the Service at 8800 yields
  connection refused. Change the nginx config in the Dockerfile first if you
  want 8800.
- **Sessions are file-based.** `SESSION_DRIVER=file` and there is no PHP redis
  client in the image (no `predis/predis`, no `phpredis` extension), so replicas
  do not share sessions. `replicaCount` defaults to 1 and `autoscaling` is off.
  Scaling out needs a shared session store or sticky sessions at the ingress.
- **Uploads are ephemeral by default.** `persistence.uploads.enabled=false`
  writes admin-uploaded images into the container filesystem, where a restart
  loses them. Enable it with an RWX storage class if more than one replica ever
  runs.
- **Host header validation is off.** `app/Http/Middleware/TrustHosts.php`
  returns `[]`, so any `Host` is accepted — this is what makes in-cluster probes
  and pod-IP traffic work. `app.url` only affects generated links.

## Values

See `values.yaml`; every key is commented.
