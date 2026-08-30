{{/* Expand the name of the chart. */}}
{{- define "hotel-management.name" -}}
{{- default .Chart.Name .Values.nameOverride | trunc 63 | trimSuffix "-" }}
{{- end }}

{{/* Fully qualified app name. */}}
{{- define "hotel-management.fullname" -}}
{{- if .Values.fullnameOverride }}
{{- .Values.fullnameOverride | trunc 63 | trimSuffix "-" }}
{{- else }}
{{- $name := default .Chart.Name .Values.nameOverride }}
{{- if contains $name .Release.Name }}
{{- .Release.Name | trunc 63 | trimSuffix "-" }}
{{- else }}
{{- printf "%s-%s" .Release.Name $name | trunc 63 | trimSuffix "-" }}
{{- end }}
{{- end }}
{{- end }}

{{- define "hotel-management.chart" -}}
{{- printf "%s-%s" .Chart.Name .Chart.Version | replace "+" "_" | trunc 63 | trimSuffix "-" }}
{{- end }}

{{- define "hotel-management.labels" -}}
helm.sh/chart: {{ include "hotel-management.chart" . }}
{{ include "hotel-management.selectorLabels" . }}
{{- if .Chart.AppVersion }}
app.kubernetes.io/version: {{ .Chart.AppVersion | quote }}
{{- end }}
app.kubernetes.io/managed-by: {{ .Release.Service }}
{{- end }}

{{- define "hotel-management.selectorLabels" -}}
app.kubernetes.io/name: {{ include "hotel-management.name" . }}
app.kubernetes.io/instance: {{ .Release.Name }}
{{- end }}

{{- define "hotel-management.serviceAccountName" -}}
{{- if .Values.serviceAccount.create }}
{{- default (include "hotel-management.fullname" .) .Values.serviceAccount.name }}
{{- else }}
{{- default "default" .Values.serviceAccount.name }}
{{- end }}
{{- end }}

{{- define "hotel-management.image" -}}
{{- printf "%s:%s" .Values.image.repository (default .Chart.AppVersion .Values.image.tag) }}
{{- end }}

{{/*
Resolve APP_KEY: explicit value wins, otherwise reuse the key already stored in
this release's Secret, otherwise generate one. `lookup` returns empty during
`helm template`/`--dry-run`, which would render a throwaway key — set app.key
explicitly for GitOps pipelines.
*/}}
{{- define "hotel-management.appKey" -}}
{{- if .Values.app.key -}}
{{- .Values.app.key -}}
{{- else -}}
{{- $secret := lookup "v1" "Secret" .Release.Namespace (include "hotel-management.fullname" .) -}}
{{- if and $secret $secret.data (hasKey $secret.data "APP_KEY") -}}
{{- index $secret.data "APP_KEY" | b64dec -}}
{{- else -}}
{{- printf "base64:%s" (randAlphaNum 32 | b64enc) -}}
{{- end -}}
{{- end -}}
{{- end }}

{{/* Environment shared by the Deployment and the migration Job. */}}
{{- define "hotel-management.podEnv" -}}
envFrom:
  - configMapRef:
      name: {{ include "hotel-management.fullname" . }}
  - secretRef:
      name: {{ include "hotel-management.fullname" . }}
{{- with .Values.extraEnvFrom }}
{{ toYaml . | indent 2 }}
{{- end }}
{{- if or .Values.database.existingSecret .Values.extraEnv }}
env:
{{- if .Values.database.existingSecret }}
  - name: DB_PASSWORD
    valueFrom:
      secretKeyRef:
        name: {{ .Values.database.existingSecret }}
        key: {{ .Values.database.existingSecretPasswordKey }}
{{- end }}
{{- with .Values.extraEnv }}
{{ toYaml . | indent 2 }}
{{- end }}
{{- end }}
{{- end }}
